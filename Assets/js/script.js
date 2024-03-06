// Ambil elemen select currency dan select amount
var currencySelect = document.getElementById("currency");
var amountSelect = document.getElementById("amount");

// Tambahkan event listener untuk perubahan di select currency
currencySelect.addEventListener("change", function() {
    // Dapatkan nilai currency yang dipilih
    var selectedCurrency = currencySelect.value;

    // Sembunyikan semua opsi di dalam select amount
    var amountOptions = amountSelect.querySelectorAll("optgroup");
    amountOptions.forEach(function(optgroup) {
        optgroup.style.display = "none";
    });

    // Tampilkan hanya opsi yang sesuai dengan mata uang yang dipilih
    var selectedAmountOptions = amountSelect.querySelectorAll('optgroup[label*="' + selectedCurrency + '"]');
    selectedAmountOptions.forEach(function(optgroup) {
        optgroup.style.display = "block";
    });
});
