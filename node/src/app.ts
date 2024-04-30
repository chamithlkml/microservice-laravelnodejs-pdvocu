import { listenForMessages } from "./rabbitmq/consume";
import { AWS_RESERVATION_QUEUE, WAIT_TIME_SECONDS } from "./secrets";
import { processMessages } from "./sqs/processMessages"; // AWS SQS Listener

(async () => {
  try{
    // while(true){
    //   await processMessages(AWS_RESERVATION_QUEUE, WAIT_TIME_SECONDS);
    // }


    const message = await listenForMessages();
    console.log("PROCESSING!!!!");
    console.log(message.content.toString());
  }catch(error){
    console.log('Error in long polling loop', error);
  }
})();