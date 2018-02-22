<?php
/*
    Marketplace Controller - github.com/CryptoCardsETH/backend
    File created by Harris Christiansen (HarrisChristiansen.com)
*/

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Listing;
use App\Models\Transaction;
use Illuminate\Support\Facades\Request;

class MarketplaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['getAllCards', 'getCardDetail', 'getAllListings']]);
    }

    /**
     * Gets all the cards.
     *
     * @return mixed cards
     */
    public function getAllCards()
    {
        return response()->build(self::RESPONSE_MESSAGE_SUCCESS, Card::with('attributes', 'user')->get());
    }

    public function getCardDetail($card_id)
    {
        return response()->build(self::RESPONSE_MESSAGE_SUCCESS, Card::with('attributes', 'user')->find($card_id));
    }

    public function updateCard($card_id)
    {
        $user = auth()->user();
        $card = Card::find($card_id);
        if (!$card->isUserOwner($user)) {
            return response()->build(self::RESPONSE_MESSAGE_ERROR_UNAUTHORIZED);
        }

        $data = json_decode(Request::getContent(), true);
        foreach ($data as $key => $value) {
            if (in_array($key, [
                Card::FIELD_HIDDEN_TOGGLE,
            ])) {
                $card->$key = $value;
            }
        }

        $card->save();

        return $this->getCardDetail($card_id);
    }

    public function buyCard($card_id)
    {
        //update card user's id with current id
        $user = auth()->user();
        $card = Card::find($card_id);
        if ($card->isUserOwner($user)) {
            return response()->build("User own the card");
        }

        $data = json_decode(Request::getContent(), true);
        foreach ($data as $key => $value) {
            if (in_array($key, [
                user_id
            ])) {
                $card->$key = $value;
            }
        }

        $card->save();

        //add transaction to the transactions table 

        $transaction = new Transaction;
        $transaction->card_id = $card_id;
        $transaction->user_id = $user_id;

        $transaction->save();
                
        return $this->getCardDetail($card_id);
    }

    public function getAllListings()
    {
        $listings = Listing::with(['cards'])->get();

        return response()->build(self::RESPONSE_MESSAGE_SUCCESS, $listings);
    }
}
