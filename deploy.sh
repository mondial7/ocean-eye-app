# TODO update API_HOST && API.HOST -> ocean-eye-landing && ocean-eye

# prepare build
bash build.sh

# update db credentials
cp -f ../EKEDB_config.php ../build/app/configs/EKEDB_config.php

# start deployment
echo '🚀🚀🚀 Ready to deploy!'

cd ../build
# echo 'put -rp ./ ./ocean-eye/' > deploy_rules # need a ssh key to use this
sftp startupradiator.com@ssh.startupradiator.com

echo '🌈🍻🍷'
echo '      https://startupradiator.com/ocean-eye/'
