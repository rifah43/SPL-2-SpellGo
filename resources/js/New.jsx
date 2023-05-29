// new.jsx

const processBubbleSortData = (score, bestTime, levelId) => {
    // Perform any necessary operations with the data
    console.log('Received Bubble Sort data:');
    console.log('Score:', score);
    console.log('Best Time:', bestTime);
    console.log('Level ID:', levelId);
  
    // Update the UI or perform other actions based on the data
    // For example, you can display the score and best time in the UI
    const scoreElement = document.getElementById('score');
    const bestTimeElement = document.getElementById('best-time');
  
    scoreElement.innerText = `Score: ${score}`;
    bestTimeElement.innerText = `Best Time: ${bestTime}`;
  
    // You can also make additional API calls or perform other actions based on the data
    // For example, you can send the data to the server for further processing
    fetch('/store', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken() // Replace with your method to get the CSRF token
      },
      body: JSON.stringify({
        score: score,
        bestTime: bestTime,
        levelId: levelId
      })
    })
      .then(response => {
        if (response.ok) {
          console.log('Bubble Sort data processed successfully.');
        } else {
          throw new Error('Error processing Bubble Sort data.');
        }
      })
      .catch(error => {
        console.error('An error occurred while processing Bubble Sort data:', error);
      });
  };
  
  window.addEventListener('bubbleSortData', (event) => {
    const { score, bestTime, levelId } = event.detail;
    processBubbleSortData(score, bestTime, levelId);
    console.log("ji");
  });
  
  export default processBubbleSortData;
  