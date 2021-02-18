function selectGroupIndexStocks(){
    var input, header, table, tr, td, i;
    // nama dropdown gua
    input = document.getElementById("selectGroupStock").value;
    // nama header yg nnt berubah2
    header = document.getElementById("groupStocksCardHeader");
    // id table gua
    table = document.getElementById("indexStocksTable");
    //ngambil row dari setiap table
    tr = table.getElementsByTagName("tr");
    // mulai dari 1 karena tr yg pertama tuh cuma no, namabarang dll
    for (i = 1; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("input")[0].value;
      if (td){
        if (input == td || input == ""){
          tr[i].style.display = "";
            if (input == ""){
              header.innerHTML = "Semua"
            } else if(input == 1){
              header.innerHTML = "Transmitter";
            } else if (input == 2){
              header.innerHTML = "Receiver"
            } else if ( input == 3){
              header.innerHTML = "Antenna"
            } else if (input == 4){
              header.innerHTML = "Tambahan"
            }
        } else {
          tr[i].style.display = "none";
        }
      } 
    }
  }