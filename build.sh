cd ..
rm -r build
# create deployment directory
mkdir build
# build frontend repositories
cd ocean-eye-landing/
echo '🔥🔥🔥 Building landing'
polymer build --preset 'es5-bundled' --base-path '/ocean-eye/app/assets/landing/'
cd ../ocean-eye/
echo '🔥🔥🔥 Building dashboard'
polymer build --preset 'es5-bundled' --base-path '/ocean-eye/app/assets/dashboard/'
cd ..
echo '🔥🔥🔥 Frontend ready'
# copy php shell app in build
cp -r ocean-eye-app/app/ build/app/
cp ocean-eye-app/.htaccess build/
cp ocean-eye-app/index.php build/
# include built frontend repos
cp -r ocean-eye-landing/build/es5-bundled/ build/app/assets/landing/
cp -r ocean-eye/build/es5-bundled/ build/app/assets/dashboard/
mv build/app/assets/landing/index.html build/app/templates/landing/index.html
mv build/app/assets/dashboard/index.html build/app/templates/dashboard/index.html
# clean logs folder
rm -rf build/app/core/logs/
echo '🔥🔥🔥 Done building'
