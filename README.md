# Install

#### Execute commands
`git clone https://github.com/AlexeyGod/test-task.git .`

#### update & download dependencies
`composer -d app update`

#### run docker-compose
`docker-compose -f docker/docker-compose.yml up -d`

#### get conainer bash
`docker exec -it docker-app-1 bash`

 and Run migrate

`php /var/www/app/yii migrate`

## Hosts

Frontend http://localhost
API service http://localhost:9000

## Add a sources and import supported content
```
yii source/add news https://www.mk.ru/rss/news/index.xml
yii source/add daily https://www.mk.ru/rss/daily/index.xml
yii import/start
```

## Supported content

RSS chanels witch stuctre:
```
<chanel>
    ...
    <item>
        ...
        <title>String</title>
        <link>String</link>
        <description>Text</description>
        <pubDate>Time as string supported php-function:strtotime</pubDate>
        ...
    </item>
    ...
</chanel>
```
`legend:`
```
    ... - optional tags
    <tag> - reqired tags
```

Required valid structure. During import, the source will be skipped if its structure is not valid.

## Other console commands (info)
```
- source                       Commands for managing news sources
    source/add                 Create a new source
    source/delete              Deletes a source by id
    source/list                List of all sources and identifiers

- import                       Commands for import news  from sources
    import/start               Run import news from sources
```