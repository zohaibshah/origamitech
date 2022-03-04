
<?php
$lcLinkRelValues = [
    'alternate',
    'author',
    'bookmark',
    'external',
    'help',
    'license',
    'next',
    'nofollow',
    'noreferrer',
    'noopener',
    'prev',
    'search',
    'tag',
];
?>
<!-- Modal Link content -->
<div class="lc-modal-header">
    <span class="lc-modal-close">&times;</span>
</div>
<div class="lc-modal-content">
    <form id="lc-modal-link-form">
        <label for="link-name">Link Text</label>
        <input id="link-name" name="link-name" type="text" value="" placeholder="None assigned">
        <label for="link-url">HREF</label>
        <input id="link-url" name="link-url" type="text" value="" placeholder="None assigned">

        <label for="lc-modal-link-classes">CLASS[es]</label>
        <input id="lc-modal-link-classes" name="lc-modal-link-id" type="text" value="" placeholder="None assigned">
        
        <div class="widget-wrapper-flex">
            <div class="flex-first-spacer">
                <label for="lc-modal-link-id">ID</label>
                <input id="lc-modal-link-id" name="lc-modal-link-id" type="text" value="" placeholder="None assigned">
            </div>
            <div>
                <label for="link-rel">Rel</label>
                <select id="link-rel" name="link-rel">
                    <option value="">---</option>
                    <?php foreach ($lcLinkRelValues as $value): ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- create a select with all rel possible values -->
            </div>
        </div>
        <label for="link-target" class="lc-check-label" ><input id="link-target" name="link-target" type="checkbox" value="1">Open in new window</label>
        <div id="button_action_modal">
            <button id="btn-modal-close" class="lc-modal-close">Cancel</button>
            <button type="submit" id="link-submit" class="lc-modal-link-submit">Update</button>
        </div>
    </form>
</div>