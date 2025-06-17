const Payment = require('../models/Payment');
const paymentResolver = {
  Query: {
    payments: async () => {
      return await Payment.find();
    }
  },
  Mutation: {
    createPayment: async (_, { amount, currency, status }) => {
      const payment = new Payment({ amount, currency, status });
      await payment.save();
      return payment;
    }
  }
};
module.exports = paymentResolver;