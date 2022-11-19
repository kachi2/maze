<?php namespace Kevupton\LaravelCoinpayments\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    /**
     * Defines the prefix for the table.
     * @param array $attr
     */
    public function __construct($attr = array()) {
        parent::__construct($attr);
        $this->setTable(cp_table_prefix() . $this->getTable());
    }
}
