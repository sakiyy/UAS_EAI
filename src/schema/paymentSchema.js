const { gql } = require('apollo-server-express');
const paymentSchema = gql`
  type Payment {
    id: ID!
    amount: Float!
    currency: String!
    status: String!
  }
  type Query {
    payments: [Payment]
  }
  type Mutation {
    createPayment(amount: Float!, currency: String!, status: String!): Payment
  }
`;
module.exports = paymentSchema;