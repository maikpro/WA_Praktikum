# android ordner löschen:
rm -r android

# www Ordner erstellen:
ionic build

# add android Platform
npx cap add android

npx cap sync android

# in android studio öffnen:
npx cap open android