#!/bin/bash

POT_TMP_FILE=lang/tmp.pot
POT_FILE=lang/alps.pot
TEXT_DOMAIN=alps

rm -f $POT_FILE
touch $POT_FILE
touch $POT_TMP_FILE

# Extract messages from PHP files
for file in $(find ./views ./app functions.php -iname '*.php'); do
  xgettext \
    --from-code=UTF-8 \
    --keyword=__:1,2c \
    --keyword=_e:1,2c \
    --join-existing \
    --output=$POT_TMP_FILE \
    $file
done

# Extract messages from Blade templates
for file in $(find ./views -iname '*.blade.php'); do
  xgettext \
    --language=Python \
    --from-code=UTF-8 \
    --keyword=__:1,2c \
    --keyword=_e:1,2c \
    --join-existing \
    --output=$POT_TMP_FILE \
    $file
done

# Replace the Content-Type header with UTF-8 charset. msggrep not work with "charset=CHARSET".
sed -i'.bak' -e 's/charset=CHARSET/charset=UTF-8/g' $POT_TMP_FILE
rm -f $POT_TMP_FILE.bak

# Filter the needed text domain in pot file
msggrep \
  --msgctxt \
  --regexp="^${TEXT_DOMAIN}$" \
  --output-file=$POT_FILE \
  $POT_TMP_FILE
rm -f $POT_TMP_FILE

# Remove the context data
sed -i'.bak' -e "/msgctxt \"${TEXT_DOMAIN}\"/d" $POT_FILE
rm -f $POT_FILE.bak

# Update the lang/alps.php file
node bin/i18n-extract-blade.js
