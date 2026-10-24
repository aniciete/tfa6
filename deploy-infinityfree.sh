#!/usr/bin/env bash
# ====================================================================
# IT0049 POS TFA6 - Automated FTP Deployment to InfinityFree
# Uploads package and extraction helper to /htdocs on ftpupload.net
# ====================================================================

set -e

DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$DIR"

# Credentials for InfinityFree account
FTP_HOST="${FTP_HOST:-ftpupload.net}"
FTP_PORT="${FTP_PORT:-21}"
FTP_USER="${FTP_USER:-if0_43258606}"
FTP_PASS="${FTP_PASS:-iHZWFG57sB42}"
REMOTE_HTDOCS="htdocs"
ZIP_NAME="tfa6-infinityfree.zip"
ZIP_PATH="$DIR/$ZIP_NAME"
EXTRACT_PHP="$DIR/extract.php"
APP_URL="${APP_URL:-http://tfa6.freedev.app}"

echo "=========================================================="
echo " Starting InfinityFree FTP Deployment for TFA6"
echo " Target Domain : $APP_URL"
echo " FTP Host      : $FTP_HOST:$FTP_PORT"
echo " FTP User      : $FTP_USER"
echo "=========================================================="

# 1. Build the production package if not already built or outdated
if [ ! -f "$ZIP_PATH" ]; then
    echo "==> Production zip not found. Running build-infinityfree-zip.sh..."
    chmod +x "$DIR/build-infinityfree-zip.sh"
    "$DIR/build-infinityfree-zip.sh"
fi

# Ensure extract.php exists
if [ ! -f "$EXTRACT_PHP" ]; then
    echo "Error: $EXTRACT_PHP missing." >&2
    exit 1
fi

# 2. Test FTP Connection
echo "==> Testing connection to $FTP_HOST:$FTP_PORT..."
curl --connect-timeout 20 --max-time 30 -s --user "$FTP_USER:$FTP_PASS" "ftp://$FTP_HOST/$REMOTE_HTDOCS/" > /dev/null
echo "✓ FTP connection established and authenticated."

# 3. Remove remote placeholder index2.html if present
echo "==> Cleaning remote placeholder index2.html..."
curl -s --user "$FTP_USER:$FTP_PASS" -Q "DELE /$REMOTE_HTDOCS/index2.html" "ftp://$FTP_HOST/$REMOTE_HTDOCS/" > /dev/null 2>&1 || true
echo "✓ Remote placeholder checked."

# 4. Upload production ZIP package
echo "==> Uploading $ZIP_NAME ($(( $(stat -f%z "$ZIP_PATH" 2>/dev/null || stat -c%s "$ZIP_PATH") / 1024 / 1024 )) MB) to /$REMOTE_HTDOCS/$ZIP_NAME..."
curl --connect-timeout 30 --max-time 600 -T "$ZIP_PATH" --user "$FTP_USER:$FTP_PASS" "ftp://$FTP_HOST/$REMOTE_HTDOCS/$ZIP_NAME"
echo "✓ Uploaded $ZIP_NAME successfully."

# 5. Upload extract.php
echo "==> Uploading extraction helper extract.php..."
curl --connect-timeout 20 --max-time 60 -T "$EXTRACT_PHP" --user "$FTP_USER:$FTP_PASS" "ftp://$FTP_HOST/$REMOTE_HTDOCS/extract.php"
echo "✓ Uploaded extract.php successfully."

# 6. Verify remote files
echo "==> Verifying remote files in /$REMOTE_HTDOCS..."
curl -s --user "$FTP_USER:$FTP_PASS" "ftp://$FTP_HOST/$REMOTE_HTDOCS/"

echo ""
echo "=========================================================="
echo " ✓ FTP UPLOAD COMPLETE!"
echo " Next step: Trigger extraction by opening:"
echo "   $APP_URL/extract.php"
echo " Or run:"
echo "   curl -sL $APP_URL/extract.php"
echo "=========================================================="
