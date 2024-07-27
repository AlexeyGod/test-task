<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m240726_193000_basicSiteStructure
 */
class m240726_193000_basicSiteStructure extends Migration
{
    public function up()
    {
        // news
        $this->createTable('news', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT,
            'source' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_TIMESTAMP
        ]);

        // sources
        $this->createTable('sources', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'url' => Schema::TYPE_STRING . ' NOT NULL'
        ]);

        echo "m240723_190744_news executed (created tables news, sources).\n";
    }

    public function down()
    {
        $this->dropTable('news');
        $this->dropTable('sources');
        echo "m240723_190744_news deleted (deleted tables news, sources).\n";

        return false;
    }
}
