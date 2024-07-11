{source}

<br>
This is a simple Object-oriented file that we can use to run any query <br>
without changing this code. However it does not support pagination <br>
<hr>
<?php

     class myObject
     {
          public $result;
          public $results;
          public $db;
          public $query;
          public $columns;
          public $Space;  

          Public Function OpenDatabase($q)
          {
                $this->db = JFactory::getDbo();
                $this->query = $this->db->getQuery(true);

                $this->query = $q;
                $this->db->setQuery($this->query);
                $this->result = $this->db->loadObjectList();
                $this->results = $this->db->loadAssocList();
                $this->columns = array_keys($this->results[0]);
           }

           Public Function PrintCheckBoxes()
           {
                echo "<form action='' method='POST'><div>";
                foreach($this->columns as &$columnName)
                {
                      echo "\n". "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". "<input id=\"" . $columnName . "\" name=\"" . 
                      $columnName . "\" type=\"checkbox\" value=\"" .
                      $columnName . "\" /><label for=\"" . $columnName . "\">&nbsp" . $columnName . "</label>";
                }

                $this->Space =  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                echo "<hr>";
                echo "</div><div><input name=\"submit\" type=\"submit\" value=\"Submit\" /></div></form>";
                echo "<br>";
           }

//==================================================================== 
           
           Public Function PrintHeader()
           {
                  //if(isset($_POST['submit']))
		  if($_SERVER["REQUEST_METHOD"] = "POST") 
                  {
                         echo "<table>";
                         echo "<tr style=\"background-color:Blue;color:White\">";
                         foreach($this->columns as &$columnName)
                                if (isset($_POST[$columnName] ) )
                                       echo "<th>" . $columnName . $this->Space . "</th>";
                         echo "</tr>";
                         echo "</table>";
                    }
           }
//====================================================================            
           Public Function PrintData()
           {   
                //if(isset($_POST['submit']))
		if($_SERVER["REQUEST_METHOD"] = "POST") 
                {
                      echo "<table>"; 
                      foreach ($this->result as &$row) 
                      {
                            echo "<tr>";
                            foreach($this->columns as &$columnName) 
                                  if (isset($_POST[$columnName] ) )
                                        echo "<td>" . $row->$columnName . $this->Space .  "</td>";
                            echo "</tr>"; // Close out the row.
                      }        
                      echo "</table>"; // Close out the table at the end of the loop.
                 }
           }
//============================================================

       public function __construct($q) 
       {
             $this->OpenDatabase($q);
             $this->PrintCheckBoxes();
             $this->PrintHeader();
             $this->PrintData();
        }
//============================================================
     } // end of the class

//******************************************************************************************
// Main program starts in here
//******************************************************************************************
     $T1 = new myObject ("Select * from Resources ");
?>
{/source}