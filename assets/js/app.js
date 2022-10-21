$(document).ready(function () {
	$(document).on("change", ".hitungtanggal", function () {
		var tgl_awal = $("input:text[name=cuti_mulai]").val();
		var tgl_akhir = $("input:text[name=cuti_berakhir]").val();
		//alert(tgl_awal);

		var tgl_aw = moment(tgl_awal);
		var tgl_ak = moment(tgl_akhir);
		var numYears, numMonths, numDays;

		tgl_aw = tgl_aw.add(numDays, "days");
		numDays = tgl_ak.diff(tgl_aw, "days");

		if (isNaN(tgl_aw) || isNaN(tgl_ak)) {
			var hasil = "0";
		} else {
			if (numDays <= 0) {
				alert("Tanggal Akhir Harus Lebih Besar Dari Tanggal Awal");
				var hasil = "0";
			} else {
				var hasil = numDays;
			}
		}

		$("input:hidden[name=jumlah_hari]").val(hasil);
		$(".jumlah_hari").html(hasil + " Hari");
	});
});
