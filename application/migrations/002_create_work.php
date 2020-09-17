<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_work extends CI_Migration {
public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));
        $this->dbforge->add_key('id');
        $this->dbforge->create_table('work');
    }
    public function down() {
        $this->dbforge->drop_table('work');
    }
}