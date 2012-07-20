You are logged in.
<form action='' method='POST'>
    <table>
        <tr>
            <?php
            foreach ($admin->template_vars['columns'] as $column) {
                echo "<th>$column</th>";
            }
            ?>
        </tr>
        <?php
            foreach ($admin->template_vars['rows'] as $row) {
                echo "<tr>";
                    foreach ($row as $column => $record) {
                        if ($column == 'id') $id = $record;
                        $editable_type = get_editable_type($admin->template_vars, $column);
                        if ($editable_type) {
                            if ($editable_type=='file') {
                                echo "<td><input type='text' value='$record' /></td>";
                            }
                            else
                            {
                                echo "<td><input type='$editable_type' name='column_{$column}_id_$id' value='$record' /></td>";
                            }
                        }
                        else
                            echo "<td>$record</td>";
                    }
                echo "</tr>";
            }
            
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
    <input type='submit' value='Update' />
</form>

