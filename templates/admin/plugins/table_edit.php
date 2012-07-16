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
                        $editable = false;
                        $editable_type = '';
                        foreach ($admin->template_vars['editable_columns'] as $editable_column) {
                            if ($editable_column->name == $column) {
                                $editable = true;
                                $editable_type = $editable_column->type;
                            }
                        }
                        if ($editable) {
                            echo "<td><input type='$editable_type' name='column_{$column}_id_$id' value='$record' /></td>";
                        }
                        else
                            echo "<td>$record</td>";
                    }
                echo "</tr>";
            }
        ?>
        
    </table>
    <input type='hidden' name='tableedit_action' value='update' />
    <input type='submit' value='Update' />
</form>

