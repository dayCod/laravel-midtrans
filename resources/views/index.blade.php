<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ $clientKey }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  </head>
 
  <body>
    <form action="" method="POST" id="post-data">
      @csrf
      <input type="hidden" id="collect-data" name="json">
    </form>
    <button id="pay-button">Pay!</button>
 
    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result);
            retrieveDataToForm(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            console.log(result);
            retrieveDataToForm(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            console.log(result);
            retrieveDataToForm(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });

      function retrieveDataToForm(result) {
        let data = document.getElementById('collect-data').value = JSON.stringify(result);
        $('#post-data').submit();
      }
    </script>
  </body>
</html>