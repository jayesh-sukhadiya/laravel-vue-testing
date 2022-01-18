<script type="text/javascript">
    $(document).ready(function() {
        var success = '{{ session("success") ? 0 : 1 }}';
        var error = '{{ session("error") ? 0 : 1 }}';
        var exception = '{{ session("exception") ? 0 : 1 }}';
        var warning = '{{ session("warning") ? 0 : 1 }}';

        if (success == 0) {
            iziToast.success({
                title: 'Success!',
                message: '{{ session("success") }}',
                position: 'topRight',
                timeout: 6000,
                pauseOnHover: true,
            });
        }
        if (error == 0) {
            iziToast.error({
                title: 'error!',
                message: '{{ session("error") }}',
                position: 'topRight',
                timeout: 6000,
            });
        }
        if(exception == 0){
            iziToast.error({
                title: 'exception!',
                message: '{{ session("exception") }}',
                position: 'topRight',
                timeout: 6000,
            });
        }
        if(warning == 0){
            iziToast.warning({
                title: 'Deleted!',
                message: '{{ session("warning") }}',
                position: 'topRight',
                timeout: 6000,
            });
        }

    });

</script>
