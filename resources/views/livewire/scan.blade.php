<div>
    <form wire:submit="scan" style="position: absolute; left: -0;" id='rfid-form'>
        @csrf
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <input type="password" id='input-rfid' wire:model="form.rfid" required maxlength="">
    </form>
</div>
@script
<script>
    const inputbox = document.getElementById('input-rfid');
    const form = document.getElementById('rfid-form');
    form.addEventListener('submit', (event) => {
        inputbox.value = '';
        setTimeout(() => {
            inputbox.focus();
        }, 500);
    });
    document.addEventListener('click', function(){
        inputbox.focus();
    });
    inputbox.focus();
</script>
@endscript