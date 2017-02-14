# hrs
Dongyue HR System

## Roadmap
- [x] CURD of members' information
- [x] Registraion and info filling in
- [ ] Access control for different teams
- [ ] Self-service registration of GitLab Tq, QA
- [ ] Synchronize with the team address list 

## Deployment

    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
    npm run dev
    // go to 'localhost:8000'
    // password can be found in UsersTableSeeder
