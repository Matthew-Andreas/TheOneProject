<?php
class MyObject {
    public $result;
    public $results;
    public $db;
    public $query;
    public $columns;
    public $space;

    public function openDatabase($q) {
        $this->db = JFactory::getDbo();
        $this->query = $this->db->getQuery(true);
        $this->space = "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
        $this->query = $q;
        $this->db->setQuery($this->query);
        $this->result = $this->db->loadObjectList();
        $this->results = $this->db->loadAssocList();
        $this->columns = array_keys($this->results[0]);
    }

    public function printHeader() {
        echo "<table>";
        echo "<tr style=\"background-color:Blue;color:White\">";
        foreach ($this->columns as $columnName) {
            echo "<th>" . $columnName . $this->space . $this->space . $this->space . "</th>";
        }
        echo "</tr>";
        echo "</table>";
    }

    public function printData() {
        echo "<table>";
        foreach ($this->result as $row) {
            echo "<tr>";
            foreach ($this->columns as $columnName) {
                echo "<td>" . $row->$columnName . $this->space . "</td>";
            }
            echo "</tr>"; // Close out the row.
        }
        echo "</table>"; // Close out the table at the end of the loop.
    }

    public function __construct($q) {
        $this->openDatabase($q);
        $this->printHeader();
        $this->printData();
    }
} // end of the class
?>
