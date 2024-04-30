import 'dotenv/config'
export const AWS_ACCESS_KEY_ID = process.env.AWS_ACCESS_KEY_ID!;
export const AWS_SECRET_ACCESS_KEY = process.env.AWS_SECRET_ACCESS_KEY!;
export const AWS_DEFAULT_REGION = process.env.AWS_DEFAULT_REGION!;
export const AWS_RESERVATION_QUEUE = process.env.AWS_RESERVATION_QUEUE!;
export const WAIT_TIME_SECONDS = parseInt(process.env.WAIT_TIME_SECONDS!);

export const RABBITMQ_HOST = process.env.RABBITMQ_HOST!;
export const RABBITMQ_USER = process.env.RABBITMQ_USER!;
export const RABBITMQ_PASSWORD = process.env.RABBITMQ_PASSWORD!;
export const RABBITMQ_PORT = parseInt(process.env.RABBITMQ_PORT!);
export const RABBITMQ_RESERVATION_QUEUE = process.env.RABBITMQ_RESERVATION_QUEUE!
export const RABBITMQ_EXCHANGE = process.env.RABBITMQ_EXCHANGE!
export const RABBITMQ_ROUTING_KEY = process.env.RABBITMQ_ROUTING_KEY!
