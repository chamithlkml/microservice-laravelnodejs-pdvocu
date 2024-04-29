import 'dotenv/config'
export const AWS_ACCESS_KEY_ID = process.env.AWS_ACCESS_KEY_ID!;
export const AWS_SECRET_ACCESS_KEY = process.env.AWS_SECRET_ACCESS_KEY!;
export const AWS_DEFAULT_REGION = process.env.AWS_DEFAULT_REGION!;
export const AWS_RESERVATION_QUEUE = process.env.AWS_RESERVATION_QUEUE!;
export const WAIT_TIME_SECONDS = parseInt(process.env.WAIT_TIME_SECONDS!);