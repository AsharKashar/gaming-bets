# Banger Games Documentation

### Branches
- Production: origin/master (Will be deployed before 2020-05-01)
- Staging: origin/staging: https://staging.bangergames.com
- Development: origin/development: https://dev.bangergames.com


## Docker Container List
- php (php-fpm 7.4)
- adminer (basic UI for DB)
- composer (this container stops after `composer install` done, we need it for `vendor` directory.): For lazy people :D
- nginx (web server)
- redis (caching)
- portainer (monitoring, debugging)
- certbot (auto renew SSL certificates)


### First Installation
Please don't use windows.
- `Docker on mac` https://docs.docker.com/docker-for-mac/install/ Register docker hub account. Download docker.dmg file, install, run Docker
- `Docker on ubuntu` https://docs.docker.com/engine/install/ubuntu/
- Install `docker-compose` https://docs.docker.com/compose/install/ (For mac included, for linux you should install your self)
- Configure BE environment file `backend/.env.dev` copy to `backend/.env`
- Configure FE environment file `frontend/config.js.example` copy to `frontend/config.js`


### Configure hosts file on local computer
- For mac and linux: /etc/hosts, add this row to end of file. If you wanna test dev server on AWS, you have to comment this row later.
```
127.0.0.1 dev.bangergames.com
```

### Run all containers on docker with docker compose
```
bash restart.sh
```
- Login to php container in docker with:
```
bash php.sh
```
- Input next commands in php container for first database installation and admin assets
```
php artisan migrate:fresh --seed
```

### Portainer
Set your admin password on first login to portainer dashboard

URL: http://127.0.0.1:9000

#### Login:
- Dev: http://18.218.80.115:9000/
- Staging: http://3.22.248.213:9000/

##### Credentials
username: `admin`

password: `B4ngerG4m3s@@`

Please use portainer for debugging, you can find here php/nginx logs as well.

- FTP password for bangergames.com /html/ directory
```text
Username: sei7845
Password: B4ngerG4m3s
```


#### TODO
- Implement `grafana`

### Merge Request

Please read to understand why we need gitflow workflow: https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow
Example issue subject: Box matches API endpoint convertation.
Example branch name for issue: box_matches_api (Because this is temporary, clear words are enough.)
You have to switch to development branch first.
```shell
git checkout development
git pull
```

Create new branch from development :
```shell
git checkout -b box_matches_api development
```
Coding time.. You might have multiple commits, it's ok. If issue will take long, please pull changes from development regularly to avoid conflicts.
git pull origin development
If you'll have some conflicts, please solve them locally!
End of work: Issue is done and tested.

Check and fix all eslint errors, before pushing to gitlab
```shell
npm run eslint:fix
```
Pushing to gitlab
```shell
git push -u origin box_matches_api
```
How to create merge request on gitlab: https://docs.gitlab.com/ee/user/project/merge_requests/creating_merge_requests.html


Merge request should looks like(very important): From box_matches_api into development
You have to enable checkbox only: Delete source branch when merge request is accepted.  -When code is merged to development: That means you passed code review and code is merged to development.
When you created Merge Request already, please move issue to Code Review column in Asana
When code reviewed and merged into development branch, who reviewed the code,  please move issue in Asana to Ready for QA, so Junaid can test it.
development into staging  can be merged by only: Junaid, Muhammed, Kenan
When Junaid tested issues on the development (https://dev.bangergames.com) He have to merge development into staging by creating Merge Request and move issue to In Staging in Asana.
At this stage we might see some bugs and same process: When issue assigned to you and moved back to In Progress cycle is same.
After In Staging Ibtsam have to update our Release doc and issue is ready for Live Site
Who can merge staging into master : After approve by business, Ibtsam have to assign issue to Muhammad or Kenan and we released code.
I hope that we will all become "gitflow" habits. This is not a strict rule. The only purpose is discipline.
