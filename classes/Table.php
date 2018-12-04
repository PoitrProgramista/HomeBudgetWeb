<?php
class Table
{
    private $title = '';
    private $columns = array();
    private $rows = array();

    function __construct($title, $columns)
    {
        $this->title = $title;
        $this->columns = $columns;
    }

    function show()
    {
        echo '  <h4>'.$this->title.'</h4>
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>';
                            $this->showColumns();
        echo '          </tr>
                    </thead>';
                    $this->showRows();
        echo '  </table>';
    }

    function showColumns()
    {
        foreach($this->columns as $column)
            echo '<th>'.$column.':</th>';
    }

    function showRows()
    {
        if ($this->rows) 
        {
            foreach ($this->rows as $key => $value) 
            {
                echo '<tr>
                        <th>'.$key.'</th>
                        <th>'.$value.'</th>
                     </tr>';
            }
        } 
        else 
        {
            echo '<tr><th colspan = '.count($this->columns).'> Brak wyników </th></tr>';
        }
    }

    public function setRows($rows)
    {
        $this->rows = $rows;
    }
}