# Sistem Informasi EECID

Sistem Informasi EECID is a web app that allows experts and managers from Era Elektra Corpora Indonesia to make maintanance reports, manage stocks, and manage user managements. This project mainly build out of PHP framework *laravel* release 8.

## Prerequisites

Before you begin, we encourage you to have these tools :
1. Git
2. XAMPP, or any local web server solution that has PHP and MySQL in it.
3. Composer
4. Visual Studio Code, or any IDE that supports Git as their Version Control
5. _OPTIONAL :_ any git tools that could help you tell how messy your branches are. Example : Git Graph extension at Visual Studio Code, or SourceTree desktop app.

## Getting Started Sistem Infromasi EECID

To start using Sistem Informasi EECID, follow these steps:
1. Clone the repo inside XAMPP htdocs (or other local web server)
2. Go to `master` branch (*master is the development branch*)
4. Copy and rename the `.env.example` to `.env`
5. Edit your credentials in the `.env` file
- Database credentials
- Mail server configuration. Eg. mailtrap
6. Run `$ composer install` in the project directory
7. Run `$ composer dump-autoload`
8. Run `$ php artisan key:generate`
9. Run `$ php artisan migrate --seed`
10. Run `$ php artisan storage:link`
11. Thats it, now run `$ php artisan serve`
12. Open your browser and fill the url `localhost:8000`
13. To test the app, use this credential to login. (This login data added by seeder)
- Admin credential email:`admin@eecid.com` password:`secret`
- Expert credential email:`eko@eecid.com` password:`12345`
- Or you can test the register features 

## Start Developing

To start developing the program, you should follow these steps:
1. Go to `master` branch
2. Make new branch `git checkout -b <the_name_of_your_new_feature_branch>`
3. If you think you've finished the changes on your branch, stage it, and put them on your local repository.
4. Push them to remote repository
5. Make a pull request from github
6. Review the pull request, resolve conflict if exists, and merge.

## We Wish We Knew These Things Before We Started Developing
* We should've used `main` for our development branch. `main` branch is actually only for our first commit. We never used them for anything else. Why? Because we're just an ignorant Uni student and we thought that `main` is just used for production. If you want to, use this branch for production or as in other words, deployment. OR make another branch from `master` branch and named it `release-<number>`, you can fill `<number>` incrementally according to preceding version, for example `release-1`, `release-2.0`, `release-2.1.2`
* We should've named our feature branch `feature-<name>`. Our feature branch naming are over the place. `report-bugfix-improvement`, `reset-rezza-04-02`, you think those are good name for a branch? Of course not. 
* Delete the branch after you have made Pull Request (PR) and merged them. As you can see, we never delete `feature` branches. Don't worry though,  if you want to revert, or see what changes that you had merged, you can see the Pull Request tab from github, there are histories of PR's that has been merged or closed.

## Made With Love By Our Team :

* [@rizkybaihaqy](https://github.com/rizkybaihaqy)
* [@rezzaldy](https://github.com/rezzaldy)
* [@hilmiwicak](https://github.com/hilmiwicak)
* [@madewantara](https://github.com/madewantara)
* [@andranugraha](https://github.com/andranugraha)
* `put your name here if you've contributed!`
