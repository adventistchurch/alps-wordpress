#!/bin/sh

set -e
set -u

npm install
npm run build
npm run wp:theme:build
npm run wp:theme:release
