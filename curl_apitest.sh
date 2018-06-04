API_HOST=http://localhost:8888/uni/radiator/ocean-eye-app/api/

DEMO_EMAIL="halo@example.com"
DEMO_PASSWORD="halohalo"

printf "\n\n✨✨✨✨✨✨✨✨✨✨✨✨\n"
printf "         Login"
printf "\n✨✨✨✨✨✨✨✨✨✨✨✨\n\n"
curl -d "userkey=$DEMO_EMAIL&password=$DEMO_PASSWORD" -X POST ${API_HOST}auth/login
printf "\n\n🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢\n\n"


printf "\n\n✨✨✨✨✨✨✨✨✨✨✨✨\n"
printf "         Logout --> Not logged (should pass session cookie to be logged)"
printf "\n✨✨✨✨✨✨✨✨✨✨✨✨\n\n"
curl -X POST ${API_HOST}auth/logout
printf "\n\n🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢\n\n"


printf "\n\n✨✨✨✨✨✨✨✨✨✨✨✨\n"
printf "         Register ---> too short password"
printf "\n✨✨✨✨✨✨✨✨✨✨✨✨\n\n"
curl -d "email=$DEMO_EMAIL&password=halo" -X POST ${API_HOST}auth/register
printf "\n\n🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢\n\n"


printf "\n\n✨✨✨✨✨✨✨✨✨✨✨✨\n"
printf "         Register ---> OK || Email already exists"
printf "\n✨✨✨✨✨✨✨✨✨✨✨✨\n\n"
curl -d "email=$DEMO_EMAIL&password=$DEMO_PASSWORD" -X POST ${API_HOST}auth/register
printf "\n\n🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢🐢\n\n"
