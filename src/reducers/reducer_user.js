import {
  LOGIN_FROM_JWT_SUCCESS,
  RECEIVE_ME,
  SET_ACCOUNTS_LIST,
  SET_NETWORK_ID,
  SET_SIGNED_MESSAGES,
  SET_WEB3_AVAILABILITY
} from '../actions/users';
const INITIAL_STATE = {
  authenticated: false,
  me: {
    email: ''
  },
  isWeb3Available: false,
  signedMessages: {},
  jwt: null,
  network_id: null,
  accounts_list: []
};

export default function(state = INITIAL_STATE, action) {
  switch (action.type) {
    case SET_WEB3_AVAILABILITY:
      return {
        ...state,
        isWeb3Available: action.isAvailable
      };
    case SET_NETWORK_ID:
      return {
        ...state,
        network_id: action.network_id
      };
    case SET_ACCOUNTS_LIST:
      return {
        ...state,
        accounts_list: action.accounts
      };
    case SET_SIGNED_MESSAGES:
      return {
        ...state,
        signedMessages: action.signedMessages
      };
    case LOGIN_FROM_JWT_SUCCESS:
      return {
        ...state,
        authenticated: true,
        jwt: action.token
      };
    case RECEIVE_ME:
      //todo: error checking
      return {
        ...state,
        me: action.me
      };
    default:
      return state;
  }
}
