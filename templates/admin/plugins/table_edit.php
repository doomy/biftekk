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
                foreach ($row as $record) {
                    echo "<td>$record</td>";
                }
            echo "</tr>";
        }
    ?>
</table>
You are logged in.
