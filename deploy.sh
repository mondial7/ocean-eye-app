# TODO update configs -> DB credentials

# prepare build
bash build.sh

# start deployment
echo '🚀🚀🚀 Ready to deploy!'

cd build
# echo 'put -rp ./ ./ocean-eye/' > deploy_rules # need a ssh key to use this
sftp startupradiator.com@ssh.startupradiator.com

echo '🌈🍻🍷'
echo '      https://startupradiator.com/ocean-eye/'
