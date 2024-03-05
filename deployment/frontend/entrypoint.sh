#!/bin/bash
set -euo pipefail

npm install --dev

exec "$@"
