<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="jquery.alerts.js"></script>
<script type="text/javascript">
    $(document).ready( function() {
		$("a#alert_button").click( function() {
			jAlert('Menampilkan alert dialog box yang berisi peringatan.', 'Alert Dialog Box');
		});
		
		$("a#confirm_button").click( function() {
			jConfirm('Apakah anda ingin menghapus data ini?', 'Confirmation Dialog Box', function(r) {
				if( r ) jAlert('Data berhasil dihapus', 'Confirmation Dialog Box Results | True')
				else jAlert('Data tidak jadi dihapus.', 'Confirmation Dialog Box Results | False');
			});
		});
		
		$("a#prompt_button").click( function() {
			jPrompt('Ketikkan kata pada textbox di bawah ini :', 'Masukkan Kata....', 'Prompt Dialog Box', function(r) {
				if( r ) jAlert('Kata yang anda masukkan : <b>' + r + '</b>', 'Dialog Box Results');
			});
		});
	});
</script>