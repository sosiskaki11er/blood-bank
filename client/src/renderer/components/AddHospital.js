import React, { useState } from 'react'
import HospitalImg from '../assets/img/hospital.png'
import { Socket } from '..'

function AddHospital({role}) {
    const user = JSON.parse(localStorage.getItem("user"))
    const [name, setName] = useState('')
    const [address, setAddress] = useState('')
    const [date, setDate] = useState('')
    const [email, setEmail] = useState('')
    const [phone, setPhone] = useState('')

    const HandleName = (name) => {
        setName(name)
    }

    const HandleAddress = (address) => {
        setAddress(address)
    }

    const HandleSubmit = () => {
        if(name && address){
            Socket.request("POST","hospital","create",`?name=${name}&address=${address}:${user.token}`)
        }
    }
  return (
    <div className='subpage'>
        <div className='component'>
            <h3>Add new hospital</h3>
            <img src={HospitalImg} className='mr-auto'/>
        </div>

        <div className='component'>
            <h3>Required information</h3>
            <div className='container flex-col gap-[16px] max-w-[676px]'>
                <div className='flex gap-[12px]'>
                    <div className='container flex-col flex-grow-[1]'>
                        <h4 className='input-header'>Hospital name*</h4>
                        <input type='text' onChange={(e) => HandleName(e.target.value)}/>
                    </div>
                </div>
                <div className='container flex-col'>
                    <h4 className='input-header'>Address</h4>
                    <input type='text' onChange={(e) => setAddress(e.target.value)}/>
                </div>
            </div>
            <div className='container flex-col gap-[16px] max-w-[676px]'>
                <button onClick={() => HandleSubmit()}>Submit</button>
                <button className='secondary'>Cancel</button>
            </div>
        </div>
    </div>
  )
}

export default AddHospital