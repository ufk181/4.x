<?php namespace ZN\Requirements\Models;

use CallController, DB, DBTool, DBForge, Arrays, GeneralException, Config;

class GrandModel extends CallController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Variable Grand Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string: empty
    //
    //--------------------------------------------------------------------------------------------------------
    protected $grandTable = '';

    protected $connect;
    protected $connectTool;
    protected $connectForge;

    //--------------------------------------------------------------------------------------------------------
    // Constructor
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        if( defined('static::connection') )
        {
            $this->connect      = DB::differentConnection(static::connection);
            $this->connectTool  = DBTool::differentConnection(static::connection);
            $this->connectForge = DBForge::differentConnection(static::connection);

            $tables = $this->connectTool->listTables();
        }
        else
        {
            $this->connect      = new DB;
            $this->connectTool  = new DBTool;
            $this->connectForge = new DBForge;

            $tables = $this->connectTool->listTables();
        }

        if( defined('static::table') )
        {
            $grandTable = static::table;
        }
        else
        {
            $grandTable = divide(str_ireplace([INTERNAL_ACCESS, 'Grand'], '', get_called_class()), '\\', -1);
        }

        $this->grandTable = strtolower($grandTable);

        if( ! in_array($this->grandTable, Arrays::map('strtolower', $tables)) )
        {
            try
            {
                throw new GeneralException(lang('Database', 'tableNotExistsError', 'Grand: '.$grandTable));
            }
            catch( GeneralException $e )
            {
                $e->continue();
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(Array $data) : Bool
    {
        return $this->connect->insert($this->grandTable, $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert ID
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function insertID() : Int
    {
        return $this->connect->insertID();
    }

    //--------------------------------------------------------------------------------------------------------
    // Is Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column
    // @param string $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function isExists(String $column, String $value) : Bool
    {
        return $this->connect->isExists($this->grandTable, $column, $value);
    }

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $select: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function select(...$select)
    {
        $this->connect->select(...$select);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Update
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function update(Array $data, String $column, String $value) : Bool
    {
        return $this->connect->where($column, $value)->update($this->grandTable, $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column: empty
    // @param string $value : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $column, String $value) : Bool
    {
        return $this->connect->where($column, $value)->delete($this->grandTable);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Get
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _get()
    {
        return $this->connect->get($this->grandTable);
    }

    //--------------------------------------------------------------------------------------------------------
    // Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function columns() : Array
    {
        return $this->_get()->columns();
    }

    //--------------------------------------------------------------------------------------------------------
    // Total Columns
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalColumns() : Int
    {
        return $this->_get()->totalColumns();
    }

    //--------------------------------------------------------------------------------------------------------
    // Row
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $printable: false
    //
    //--------------------------------------------------------------------------------------------------------
    public function row($printable = false)
    {
        return $this->_get()->row($printable);
    }

    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: object
    //
    //--------------------------------------------------------------------------------------------------------
    public function result(String $type = 'object')
    {
        return $this->_get()->result($type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Increment
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $columns  : empty
    // @param int   $increment: 1
    //
    //--------------------------------------------------------------------------------------------------------
    public function increment($columns, Int $increment = 1) : Bool
    {
        return $this->connect->increment($this->grandTable, $columns, $increment);
    }

    //--------------------------------------------------------------------------------------------------------
    // Decrement
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $columns  : empty
    // @param int   $decrement: 1
    //
    //--------------------------------------------------------------------------------------------------------
    public function decrement($columns, Int $decrement = 1) : Bool
    {
        return $this->connect->decrement($this->grandTable, $columns, $decrement);
    }

    //--------------------------------------------------------------------------------------------------------
    // Status
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $type: row
    //
    //--------------------------------------------------------------------------------------------------------
    public function status(String $type = 'row')
    {
        return $this->connect->status($this->grandTable)->$type();
    }

    //--------------------------------------------------------------------------------------------------------
    // Total Rows
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $status: false
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalRows(Bool $status = false) : Int
    {
        return $this->_get()->totalRows($status);
    }

    //--------------------------------------------------------------------------------------------------------
    // Where
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column : empty
    // @param string $value  : empty
    // @param string $logical: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function where($column, String $value = NULL, String $logical = NULL)
    {
        $this->connect->where($column, $value, $logical);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Having
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $column : empty
    // @param string $value  : empty
    // @param string $logical: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function having($column, String $value = NULL, String $logical = NULL)
    {
        $this->connect->having($column, $value, $logical);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Where Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function whereGroup(...$args)
    {
        $this->connect->whereGroup(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Having Group
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function havingGroup(...$args)
    {
        $this->connect->havingGroup(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Inner Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table      : empty
    // @param string $otherColumn: empty
    // @param string $operator   : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function innerJoin(String $table, String $otherColumn, String $operator = '=')
    {
        $this->connect->innerJoin($table, $otherColumn, $operator);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Outer Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table      : empty
    // @param string $otherColumn: empty
    // @param string $operator   : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function outerJoin(String $table, String $otherColumn, String $operator = '=')
    {
        $this->connect->outerJoin($table, $otherColumn, $operator);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Left Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table      : empty
    // @param string $otherColumn: empty
    // @param string $operator   : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function leftJoin(String $table, String $otherColumn, String $operator = '=')
    {
        $this->connect->leftJoin($table, $otherColumn, $operator);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Right Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table      : empty
    // @param string $otherColumn: empty
    // @param string $operator   : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function rightJoin(String $table, String $otherColumn, String $operator = '=')
    {
        $this->connect->rightJoin($table, $otherColumn, $operator);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Join
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $table    : empty
    // @param string $condition: empty
    // @param string $type     : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function join(String $table, String $condition, String $type = NULL)
    {
        $this->connect->join($table, $condition, $type);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Duplicate Check
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function duplicateCheck(...$args)
    {
        $this->connect->duplicateCheck(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Order By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $condition: empty
    // @param string $type     : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function orderBy($condition, String $type = NULL)
    {
        $this->connect->orderBy($condition, $type);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Group By
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string ...$args
    //
    //--------------------------------------------------------------------------------------------------------
    public function groupBy(...$args)
    {
        $this->connect->groupBy(...$args);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Limit
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $start: 0
    // @param int   $limit: 0
    //
    //--------------------------------------------------------------------------------------------------------
    public function limit($start = 0, Int $limit = 0)
    {
        $this->connect->limit($start, $limit);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Pagination
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $url     : empty
    // @param array  $settings: empty
    // @param bool   $output  : true
    //
    //--------------------------------------------------------------------------------------------------------
    public function pagination(String $url = NULL, Array $settings = [], Bool $output = true)
    {
        return $this->_get()->pagination($url, $settings, $output);
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data : empty
    // @param string $extra: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(Array $data, $extra = NULL) : Bool
    {
        return $this->connectForge->createTable($this->grandTable, $data, $extra);
    }

    //--------------------------------------------------------------------------------------------------------
    // Drop
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function drop() : Bool
    {
        return $this->connectForge->dropTable($this->grandTable);
    }

    //--------------------------------------------------------------------------------------------------------
    // Truncate
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function truncate() : Bool
    {
        return $this->connectForge->truncate($this->grandTable);
    }

    //--------------------------------------------------------------------------------------------------------
    // Rename
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $newName: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function rename(String $newName) : Bool
    {
        return $this->connectForge->renameTable($this->grandTable, $newName);
    }

    //--------------------------------------------------------------------------------------------------------
    // Add Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $column: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function addColumn(Array $column) : Bool
    {
        return $this->connectForge->addColumn($this->grandTable, $column);
    }

    //--------------------------------------------------------------------------------------------------------
    // Drop Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $column: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function dropColumn($column) : Bool
    {
        return $this->connectForge->dropColumn($this->grandTable, $column);
    }

    //--------------------------------------------------------------------------------------------------------
    // Modify Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $column: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function modifyColumn(Array $column) : Bool
    {
        return $this->connectForge->modifyColumn($this->grandTable, $column);
    }

    //--------------------------------------------------------------------------------------------------------
    // Rename Column
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $column: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function renameColumn(Array $column) : Bool
    {
        return $this->connectForge->renameColumn($this->grandTable, $column);
    }

    //--------------------------------------------------------------------------------------------------------
    // Optimize
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function optimize() : String
    {
        return $this->connectTool->optimizeTables($this->grandTable);
    }

    //--------------------------------------------------------------------------------------------------------
    // Repair
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function repair() : String
    {
        return $this->connectTool->repairTables($this->grandTable);
    }

    //--------------------------------------------------------------------------------------------------------
    // Backup
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fileName: empty
    // @param string $path    : const STORAGE_DIR
    //
    //--------------------------------------------------------------------------------------------------------
    public function backup(String $fileName = NULL, String $path = STORAGE_DIR) : String
    {
        return $this->connectTool->backup($this->grandTable, $fileName, $path);
    }

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function error()
    {
        if( $error = $this->connectForge->error() )
        {
            return $error;
        }
        elseif( $error = $this->connectTool->error() )
        {
            return $error;
        }
        elseif( $error = $this->connect->error() )
        {
            return $error;
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Error
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function stringQuery()
    {
        if( $string = $this->connectForge->stringQuery() )
        {
            return $string;
        }
        elseif( $string = $this->connectTool->stringQuery() )
        {
            return $string;
        }
        elseif( $string = $this->connect->stringQuery() )
        {
            return $string;
        }
        else
        {
            return false;
        }
    }
}

class_alias('ZN\Requirements\Models\GrandModel', 'GrandModel');
