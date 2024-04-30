import amqplib, { ConsumeMessage } from 'amqplib'
import { RABBITMQ_RESERVATION_QUEUE, RABBITMQ_HOST, RABBITMQ_PORT, RABBITMQ_USER, RABBITMQ_PASSWORD, RABBITMQ_EXCHANGE, RABBITMQ_ROUTING_KEY } from '../secrets'

export const listenForMessages = async (): Promise<ConsumeMessage> => {
  return new Promise(async (resolve, reject) => {
    try {
      const connection = await amqplib.connect(`amqp://${RABBITMQ_USER}:${RABBITMQ_PASSWORD}@${RABBITMQ_HOST}:${RABBITMQ_PORT}/`)
      const channel = await connection.createChannel();
      await channel.assertExchange(RABBITMQ_EXCHANGE, 'direct', {durable: false});    
      await channel.assertQueue(RABBITMQ_RESERVATION_QUEUE, {durable: false});
      await channel.bindQueue(RABBITMQ_RESERVATION_QUEUE, RABBITMQ_EXCHANGE, RABBITMQ_ROUTING_KEY)
  
      await channel.consume(
        RABBITMQ_RESERVATION_QUEUE,
        (message) => {
          if(message){
            console.log('RECEIVED MESSAGE', message.content.toString());
            resolve(message);
            channel.ack(message);
          }else{
            console.log('Consumer cancelled by server')
          }
        }
      );
  
      console.log('waiting for messages');
    } catch (error) {
      console.error(error);
      reject(error);
    } 
  });
};