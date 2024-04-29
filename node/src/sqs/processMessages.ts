import { SQSClient, ReceiveMessageCommand, DeleteMessageCommand } from "@aws-sdk/client-sqs";
import { AWS_DEFAULT_REGION } from "../secrets";

const sqsClient = new SQSClient({ region: AWS_DEFAULT_REGION })

export const processMessages = async (queueUrl: string, waitTimeSeconds: number): Promise<void> => {
  try {
    const command = new ReceiveMessageCommand({
      QueueUrl: queueUrl,
      MaxNumberOfMessages: 1,
      WaitTimeSeconds: waitTimeSeconds
    })

    const response = await sqsClient.send(command);

    if(response.Messages){
      const message = response.Messages[0];

      if(message){
        //Processing
        console.log("Received Message: ", message.Body);
        
        const deleteCommand = new DeleteMessageCommand({
          QueueUrl: queueUrl,
          ReceiptHandle: message.ReceiptHandle!
        })
        await sqsClient.send(deleteCommand);
        console.log("message deleted");
      }
    }else{
      console.log("No messages received on the poll");
    }
  } catch (error) {
    console.error(error);
    throw error;
  }
}