#!/bin/bash
# git_scrub_instructions.sh
# WARNING: Run only after rotating all exposed credentials and backing up your repo.
# This script contains recommended git-filter-repo commands to remove secrets from history.
# Install git-filter-repo: https://github.com/newren/git-filter-repo

set -e

echo "1) Ensure you have a backup: create a clone:"
echo "   git clone --mirror /path/to/repo repo-mirror.git"

cat <<'EOF'
# Example: replace occurrences of a secret with <REDACTED>
# Replace PAYSTACK secret
git filter-repo --replace-text <(printf "s/OLD_PAYSTACK_SECRET/REDACTED_PAYSTACK/g")

# Replace DB password
git filter-repo --replace-text <(printf "s/GH)3y[YuY15v5j/REDACTED_DB_PASSWORD/g")

# Replace SMTP password
git filter-repo --replace-text <(printf "s/#n=N]ouVpbWq/REDACTED_SMTP_PASSWORD/g")
EOF

echo "After running, force-push the cleaned branches to remote and inform your team to reclone. See README in this script for full steps." 

echo "Note: git-filter-repo modifies history; coordinate with your team and rotate credentials first."
