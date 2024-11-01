<h3>Postie Settings </h3>
<p></p>
<table class="form-table">
    <tbody>
        <tr>
            <th scope="row">Enable Postie Integration</th>
            <td><input type="checkbox" http:="" <?php echo $enable_postie; ?> name="swpm-addon-enable-postie" value="checked='checked'"/><br><i>Enable/disable Postie Integration</i></td>
        </tr>
        <tr>
            <th scope="row">Enable Access to Membership Level</th>
            <td><select name="swpm-addon-postie-level">
                    <?php echo SwpmUtils::membership_level_dropdown($postie_level); ?>
                </select><br>
                <i> All Postie posts can be by this membership level</i></td>
        </tr>
    </tbody>
</table>