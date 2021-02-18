function selectGroupIndexStocks(){
  var input, header, table, tr, td, i;
  input = document.getElementById("selectGroupStock").value;
  // let stocks = JSON.parse(document.getElementById("stockDatas").value);
  // console.log(stocks[1].stock_id);
  header = document.getElementById("groupStocksCardHeader");
  table = document.getElementById("indexStocksTable");
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
        // header.innerHTML = "";
      }
    } 
  }
    // if (td) {
    //   if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
    //     tr[i].style.display = "";
    //   } else {
    //     tr[i].style.display = "none";
    //   }
    // }       
}
