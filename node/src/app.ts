import { AWS_RESERVATION_QUEUE, WAIT_TIME_SECONDS } from "./secrets";
import { processMessages } from "./sqs/processMessages";

(async () => {
  try{
    while(true){
      await processMessages(AWS_RESERVATION_QUEUE, WAIT_TIME_SECONDS);
    }
  }catch(error){
    console.log('Error in long polling loop', error);
  }
})();