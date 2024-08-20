<?php
class DatabaseTable {
    public $result;
    public $results;
    public $db;
    public $query;
    public $originalQuery;
    public $columns;
    public $space;
    public $limit = 10; // Number of items per page
    public $page;

    public function openDatabase($q) {
        $this->db = JFactory::getDbo();
        $this->query = $this->db->getQuery(true);
        $this->space = "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
        $this->originalQuery = $q; // Store the original query
        $this->query = $q;
        $this->db->setQuery($this->query);
        $this->result = $this->db->loadObjectList(); 
        $this->results = $this->db->loadAssocList();
        $this->columns = array_keys($this->results[0]);
    }

    public function applyPagination() {
        // Calculate the total number of rows
        $countQuery = "SELECT COUNT(*) FROM (" . $this->originalQuery . ") AS total"; 
        $this->db->setQuery($countQuery);
        $totalRows = $this->db->loadResult();

        // Calculate total pages
        $totalPages = ceil($totalRows / $this->limit);

        // Get current page and calculate the starting point
        $this->page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($this->page - 1) * $this->limit;

        // Modify the query to include LIMIT for pagination
        $this->query = $this->originalQuery . " LIMIT $start, $this->limit";
        $this->db->setQuery($this->query);
        $this->result = $this->db->loadObjectList(); 
    }

    public function printHeader() {
        echo "<table>";
        echo "<tr style=\"background-color:#203A72;color:White\">";
        foreach ($this->columns as $columnName) {
            $result = str_replace('_', ' ', $columnName);
            echo "<th>" . $result ."</th>";
        }
        echo "</tr>";
    }

    public function printData() {
        foreach ($this->result as $row) {
            echo "<tr>";
            foreach ($this->columns as $columnName) {
                echo "<td>" . $row->$columnName . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<div class=\"bottomTable\"></div>";
    }

    public function printPagination() {
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
    
            echo '<div class="pagination">';
    
            // Previous button
            if ($this->page > 1) {
                echo '<a href="?page=' . ($this->page - 1) . '" class="page-link">Previous</a>';
            }
    
            // First page link
            if ($paginationStart > 1) {
                echo '<a href="?page=1" class="page-link">1</a>';
                if ($paginationStart > 2) {
                    echo '<span class="ellipsis">...</span>';
                }
            }
    
            // Page links
            for ($i = $paginationStart; $i <= $paginationEnd; $i++) {
                if ($i == $this->page) {
                    echo '<span class="current-page">' . $i . '</span>';
                } else {
                    echo '<a href="?page=' . $i . '" class="page-link">' . $i . '</a>';
                }
            }
    
            // Last page link
            if ($paginationEnd < $totalPages) {
                if ($paginationEnd < $totalPages - 1) {
                    echo '<span class="ellipsis">...</span>';
                }
                echo '<a href="?page=' . $totalPages . '" class="page-link">' . $totalPages . '</a>';
            }
    
            // Next button
            if ($this->page < $totalPages) {
                echo '<a href="?page=' . ($this->page + 1) . '" class="page-link">Next</a>';
            }
    
            echo '</div>';
        }
    }
    

    public function __construct($q) {
        $this->openDatabase($q);
        $this->applyPagination();
        $this->printHeader();
        $this->printData();
        $this->printPagination();
    }
}
?>