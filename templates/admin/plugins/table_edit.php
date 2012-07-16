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
                        if (in_array($column, $admin->template_vars['editable_columns'])) {
                            echo "<td><input type='text' name='column_{$column}_id_$id' value='$record' /></td>";
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

