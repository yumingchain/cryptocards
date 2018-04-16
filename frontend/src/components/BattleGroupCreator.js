import React from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import { setCardFilterText, setCardSortOption } from '../actions/cards';
import { startWatchingTransaction } from '../actions/contracts';
import PropTypes from 'prop-types';
import { CONTRACT_NAME_BATTLEGROUPS } from './../contracts';
import {
  isReadyForContract,
  waitForTxToBeMined,
  getContractInstanceByName
} from '../selectors';
import { Button } from 'reactstrap';
class BattleGroupCreator extends React.Component {
  doContract = (
    senderAddress,
    contractInstance,
    cardIds,
    startWatchingTransaction
  ) => {
    //todo: web3 check
    contractInstance
      .createBattleGroup(senderAddress, cardIds, {
        from: senderAddress
      })
      .then(txHash => {
        console.log('Transaction sent');
        console.dir(txHash);
        waitForTxToBeMined(txHash);
        startWatchingTransaction(txHash);
      })
      .catch(console.error);
  };

  render() {
    let {
      ready,
      contractInstance,
      startWatchingTransaction,
      cardIds
    } = this.props;

    let truncated = cardIds.slice(0, 5);
    while (truncated.length !== 5) {
      truncated.push(0);
    }

    return (
      <div>
        <pre>selected cards: {JSON.stringify(truncated)}</pre>
        <Button
          disabled={!ready}
          onClick={() =>
            this.doContract(
              this.props.user.main_address,
              contractInstance,
              truncated,
              startWatchingTransaction
            )
          }
        >
          {ready ? 'create battlegroup' : 'loading...'}
        </Button>
      </div>
    );
  }
}

BattleGroupCreator.propTypes = {
  carddIds: PropTypes.array.isRequired
};

function mapStateToProps(state) {
  let { card, user } = state;
  return {
    card,
    user,
    ready: isReadyForContract(state),
    contractInstance: getContractInstanceByName(
      state,
      CONTRACT_NAME_BATTLEGROUPS
    )
  };
}

const mapDispatchToProps = dispatch => {
  return bindActionCreators(
    {
      setCardFilterText,
      startWatchingTransaction,
      setCardSortOption
    },
    dispatch
  );
};
export default connect(mapStateToProps, mapDispatchToProps)(BattleGroupCreator);
