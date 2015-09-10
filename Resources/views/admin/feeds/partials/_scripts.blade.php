<script>
    $( document ).ready(function() {
        $(document).keypressAction({
            actions: [
                { key: 'b', route: "<?= route('admin.ffnet.matchdays.index') ?>" }
            ]
        });



    });
</script>