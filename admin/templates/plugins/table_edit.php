<?php // version 3 ?>
You are logged in.
<form action='' enctype="multipart/form-data" id='table_form' method='POST'>
    <table>
        <tr>
            <?php
            foreach ($admin->template_vars['columns'] as $column) {
                echo "<th>$column</th>";
            }
            ?>
        </tr>
        <?php
            $store_columns = true;
            foreach ($admin->template_vars['rows'] as $row) {
                echo "<tr>";

                    foreach ($row as $column => $record) {
                        if ($store_columns) $columns[] = $column;
                        if ($column == 'id') $id = $record;
                        $editable_type = get_editable_type($admin->template_vars, $column);
                        if ($editable_type) {
                            if ($editable_type=='file') {
                                echo "<td><input type='text' value='$record' name='column_{$column}_id_$id' class='fileinput' id='file-$column-$id' /></td>";
                            }
                            else
                            {
                                echo "<td><input type='$editable_type' name='column_{$column}_id_$id' value='$record' /></td>";
                            }
                        }
                        else
                            echo "<td>$record</td>";
                    }
                $store_columns = false;
                echo "</tr>";
            }
            $id++;
            echo "<tr class='hidden' id='newline'>";
            foreach ($columns as $column) {
                $editable_type = get_editable_type($admin->template_vars, $column);
                if ($editable_type) {
                    if ($editable_type=='file') {
                        echo "<td><input type='text' value='' name='newcol_{$column}_id_$id' placeholder='select a file...' class='fileinput' id='file-$column-$id' /></td>";
                    }
                    else
                    {
                        echo "<td><input type='$editable_type' name='newcol_{$column}_id_$id' value='' /></td>";
                    }
                }
                else
                    echo "<td>$id</td>";
            }
            echo "</tr>";
            
            function get_editable_type($template_vars, $column) {
                foreach ($template_vars['editable_columns'] as $editable_column) {
                    if ($editable_column->name == $column) {
                        return $editable_column->type;
                    }
                }
                return false;
            }
        ?>
        
    </table>
    <input type='hidden' name='tableedit_action' value='update' />
    <input type='button' id='add_new_button' value='Add a new row' />
    <input type='submit' value='Update' />
</form>

