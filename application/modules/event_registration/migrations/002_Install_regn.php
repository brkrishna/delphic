<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_regn extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'regn';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'category' => array(
            'type'       => 'BIGINT',
            'null'       => true,
        ),
        'style' => array(
            'type'       => 'BIGINT',
            'null'       => true,
        ),
        'performance' => array(
            'type'       => 'BIGINT',
            'null'       => true,
        ),
        'team' => array(
            'type'       => 'BIGINT',
            'null'       => true,
        ),
        'notes' => array(
            'type'       => 'TEXT',
            'null'       => true,
        ),
        'attach_1' => array(
            'type'       => 'TEXT',
            'null'       => true,
        ),
        'attach_2' => array(
            'type'       => 'TEXT',
            'null'       => true,
        ),
        'attach_3' => array(
            'type'       => 'TEXT',
            'null'       => true,
        ),
        'attach_4' => array(
            'type'       => 'TEXT',
            'null'       => true,
        ),
        'attach_5' => array(
            'type'       => 'TEXT',
            'null'       => true,
        ),
        'deleted' => array(
            'type'       => 'TINYINT',
            'constraint' => 1,
            'default'    => '0',
        ),
        'deleted_by' => array(
            'type'       => 'BIGINT',
            'constraint' => 20,
            'null'       => true,
        ),
        'created_on' => array(
            'type'       => 'datetime',
            'default'    => '0000-00-00 00:00:00',
        ),
        'created_by' => array(
            'type'       => 'BIGINT',
            'constraint' => 20,
            'null'       => false,
        ),
        'modified_on' => array(
            'type'       => 'datetime',
            'default'    => '0000-00-00 00:00:00',
        ),
        'modified_by' => array(
            'type'       => 'BIGINT',
            'constraint' => 20,
            'null'       => true,
        ),
	);

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table($this->table_name);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}
}