<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpcServer.proto

namespace RpcServer;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>rpcServer.BattleGroupInfoRequest</code>
 */
class BattleGroupInfoRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.rpcServer.ContractAddress contract = 1;</code>
     */
    private $contract = null;

    public function __construct() {
        \GPBMetadata\RpcServer::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.rpcServer.ContractAddress contract = 1;</code>
     * @return \RpcServer\ContractAddress
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Generated from protobuf field <code>.rpcServer.ContractAddress contract = 1;</code>
     * @param \RpcServer\ContractAddress $var
     * @return $this
     */
    public function setContract($var)
    {
        GPBUtil::checkMessage($var, \RpcServer\ContractAddress::class);
        $this->contract = $var;

        return $this;
    }

}

