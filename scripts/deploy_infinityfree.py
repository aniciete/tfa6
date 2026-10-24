#!/usr/bin/env python3
"""
Automated FTP Deployment for IT0049 POS TFA6 to InfinityFree.
Packages the application and uploads tfa6-infinityfree.zip + extract.php to /htdocs on ftpupload.net.
"""

import ftplib
import os
import subprocess
import sys
from pathlib import Path

BASE_DIR = Path(__file__).resolve().parent.parent
ZIP_PATH = BASE_DIR / "tfa6-infinityfree.zip"
EXTRACT_PHP = BASE_DIR / "extract.php"

def load_credentials():
    return {
        "FTP_HOST": os.getenv("FTP_HOST", "ftpupload.net"),
        "FTP_PORT": int(os.getenv("FTP_PORT", "21")),
        "FTP_USER": os.getenv("FTP_USER", "if0_43258606"),
        "FTP_PASS": os.getenv("FTP_PASS", "iHZWFG57sB42"),
        "APP_URL": os.getenv("APP_URL", "http://tfa6.freedev.app"),
    }

def build_package():
    print("==> Packaging lean production build via build-infinityfree-zip.sh ...")
    res = subprocess.run([str(BASE_DIR / "build-infinityfree-zip.sh")], cwd=str(BASE_DIR))
    if res.returncode != 0:
        raise RuntimeError("Build script failed!")

def deploy():
    creds = load_credentials()
    host = creds["FTP_HOST"]
    port = creds["FTP_PORT"]
    user = creds["FTP_USER"]
    password = creds["FTP_PASS"]

    if not ZIP_PATH.exists():
        build_package()

    print(f"Connecting to FTP {host}:{port} as {user} ...")
    ftp = ftplib.FTP(timeout=45)
    ftp.connect(host, port)
    ftp.login(user, password)
    print("✓ FTP connected and authenticated.")

    try:
        ftp.cwd("htdocs")
        print("✓ Changed remote directory to /htdocs")

        # Remove index2.html placeholder
        try:
            files = ftp.nlst()
            if "index2.html" in files:
                ftp.delete("index2.html")
                print("✓ Removed default hosting placeholder 'index2.html'.")
        except Exception as e:
            print(f"Note on index2.html removal: {e}")

        # Upload ZIP
        zip_size_mb = ZIP_PATH.stat().st_size / (1024 * 1024)
        print(f"==> Uploading {ZIP_PATH.name} ({zip_size_mb:.2f} MB) via FTP ...")
        with open(ZIP_PATH, "rb") as f:
            ftp.storbinary(f"STOR {ZIP_PATH.name}", f, blocksize=65536)
        print(f"✓ Uploaded {ZIP_PATH.name} successfully.")

        # Upload extract.php
        print("==> Uploading extract.php ...")
        with open(EXTRACT_PHP, "rb") as f:
            ftp.storbinary("STOR extract.php", f)
        print("✓ Uploaded extract.php successfully.")

        # Verify remote listing
        print("\n==> Remote /htdocs contents:")
        ftp.dir()

        print("\n" + "=" * 56)
        print(" ✓ DEPLOYMENT UPLOAD COMPLETE!")
        print(f" Next step: Trigger extraction by opening:")
        print(f"   {creds['APP_URL']}/extract.php")
        print("=" * 56)
    finally:
        try:
            ftp.quit()
        except Exception:
            pass

if __name__ == "__main__":
    deploy()
