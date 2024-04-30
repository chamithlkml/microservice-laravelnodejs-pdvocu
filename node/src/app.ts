import { listenForMessages } from "./rabbitmq/consume";
import { AWS_RESERVATION_QUEUE, WAIT_TIME_SECONDS } from "./secrets";
import { processMessages } from "./sqs/processMessages"; // AWS SQS Listener

(async () => {
  try{
    // while(true){
    //   await processMessages(AWS_RESERVATION_QUEUE, WAIT_TIME_SECONDS);
    // }


    await listenForMessages();
  }catch(error){
    console.log('Error in long polling loop', error);
  }
})();