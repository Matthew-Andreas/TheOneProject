<?php

$directCall = false;
if (!defined('_JEXEC')) {
    $directCall = true;
    define('_JEXEC', 1);
    define('JPATH_BASE', dirname(__FILE__, 7)); // adjust if needed
    require_once JPATH_BASE . '/includes/defines.php';
    require_once JPATH_BASE . '/includes/framework.php';
}

use Joomla\CMS\Factory;

class DatabaseTable {
    public $result;
    public $results;
    public $db;
    public $query;
    public $originalQuery;
    public $columns;
    public $limit; // Number of items per page
    public $page;

    private function openDatabase($q) {
        try {
            $this->db = JFactory::getDbo();
            $this->query = $this->db->getQuery(true);
            $this->originalQuery = $q; // Store the original query
            $this->query = $q;
            $this->db->setQuery($this->query);
            $this->result = $this->db->loadObjectList(); 
            $this->results = $this->db->loadAssocList();
            $this->columns = array_filter(array_keys($this->results[0]), function($col) {
                return $col !== 'Website';
            });
        } catch (Exception $e) {
            http_response_code(400); // Set HTTP status code (avoid 500)
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    private function applyPagination() {
        // Calculate the total number of rows
        $countQuery = "SELECT COUNT(*) FROM (" . $this->originalQuery . ") AS total"; 
        $this->db->setQuery($countQuery);
        $totalRows = $this->db->loadResult();

        // Calculate total pages
        $totalPages = ceil($totalRows / $this->limit);

        // Get current page and calculate the starting point
        //$this->page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($this->page - 1) * $this->limit;

        // Modify the query to include LIMIT for pagination
        $this->query = $this->originalQuery . " LIMIT $start, $this->limit";
        $this->db->setQuery($this->query);
        $this->result = $this->db->loadObjectList(); 
    }

    private function printHeader() {
        echo "<table id='databaseTable'>";
        echo "<tr style=\"background-color:#203A72;color:White\">";
        foreach ($this->columns as $columnName) {
            $result = str_replace('_', ' ', $columnName);
            if($result == "Sector"){
                echo "<th>" . "Entrepreneur Demographics" ."</th>";
            }else if(!($result == "Website")){
                echo "<th>" . $result ."</th>";
            }

        }
        echo "</tr>";
    }

    private function printData() {
        $website = "Website";
        $i = 0;
        foreach ($this->result as $row) {
            if($i%2 == 0){
                echo "<tr>";
            }else{
                echo "<tr style=\"background-color:#f0f4fb\">";
            }
            $i = $i + 1;
            foreach ($this->columns as $columnName) {
                if($columnName =="Name_of_Organization"){
                    echo "<td><a class='nameOfOrgLink' href='" . $row->$website ."' target='_blank' rel='noopener noreferrer'>" . $row->$columnName . "</a></td>";
                }else if($columnName =="Website"){
                    //echo "<td class='websiteCell'>" . $row->$columnName . "</td>";
                }else{
                    echo "<td>" . $row->$columnName . "</td>";
                }
                
            }
            echo "</tr>";
        }
    }

    private function printBottomTable(){
        echo "<tr style=\"background-color:#203A72;color:#203A72\">";
        foreach ($this->columns as $columnName) {
            $result = str_replace('_', ' ', $columnName);
            //echo "<th class='bottomTable'>" . $result ."</th>";
            echo "<th class='bottomTable'>" . "Hello" ."</th>";
        }
        echo "</tr>";
        echo "</table>";
    }

    private function printPagination() {
        // Calculate the total number of rows
        $countQuery = "SELECT COUNT(*) FROM (" . $this->originalQuery . ") AS total";
        
        $this->db->setQuery($countQuery);
        $totalRows = $this->db->loadResult();
        $totalPages = ceil($totalRows / $this->limit);
        // Only display pagination if there is more than one page
        if ($totalPages > 1) {
            $pageRange = 2; // Number of pages to show on each side of the current page
            $paginationStart = max(1, $this->page - $pageRange);
            $paginationEnd = min($totalPages, $this->page + $pageRange);
    
            echo '<div class="pagination" id="pagination">';
    
            // Previous button
            if ($this->page > 1) {
                echo '<button class="page-link" onclick="loadPage(' . ($this->page - 1) . ')">Previous</button>';
            }
    
            // First page button
            if ($paginationStart > 1) {
                echo '<button class="page-link" onclick="loadPage(1)">1</button>';
                if ($paginationStart > 2) {
                    echo '<span class="ellipsis">...</span>';
                }
            }
    
            // Page buttons
            for ($i = $paginationStart; $i <= $paginationEnd; $i++) {
                if ($i == $this->page) {
                    echo '<span class="current-page">' . $i . '</span>';
                } else {
                    echo '<button class="page-link" onclick="loadPage(' . $i . ')">' . $i . '</button>';
                }
            }
    
            // Last page button
            if ($paginationEnd < $totalPages) {
                if ($paginationEnd < $totalPages - 1) {
                    echo '<span class="ellipsis">...</span>';
                }
                echo '<button class="page-link" onclick="loadPage(' . $totalPages . ')">' . $totalPages . '</button>';
            }
    
            // Next button
            if ($this->page < $totalPages) {
                echo '<button class="page-link" onclick="loadPage(' . ($this->page + 1) . ')">Next</button>';
            }
    
            echo '</div>';
        }
    }
    

    public function __construct($q,$mPage,$itemLimit) {
        $this->page = $mPage;
        $this->limit = $itemLimit;
        $this->openDatabase($q);
        $this->applyPagination();
        $this->printHeader();
        $this->printData();
        $this->printBottomTable();
        $this->printPagination();
    }
}
?>