    
    // incase you want to send data
    const params = { param1: 'value1', param2: 'value2' };
    const queryString = new URLSearchParams(params).toString();

    // prepare the channel url (Endpoint where we should listen for message eg.channel.php)
    const url = 'channel.php?' + queryString;

    // create a new EventSoure Obj
    let eventSource = new EventSource(url)

    // Define the event listener to handle incoming events
    eventSource.addEventListener('message', function(event) {
        const eventData = JSON.parse(event.data);
        console.log('Received event:', eventData);
    });

    // Handle errors and connection closures
    eventSource.addEventListener('error', function(event) {
        if (event.readyState === EventSource.CLOSED) {
            console.log('Connection closed.');
        } else {
           // console.log('Error occurred:', event); // hardly use
        }
     });