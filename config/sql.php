<?php

abstract class SQL{
    const INSERT = "INSERT INTO ";
    const SELECT = "SELECT ";
    const UPDATE = "UPDATE ";
    const DELETE = "DELETE FROM ";

    const FROM = " FROM ";
    const SET = " SET ";
    const WHERE = " WHERE ";

    const begin_columns = " (";
    const end_columns = ") ";

    const begin_values = " VALUES(";
    const end_values = ")";

    const user_table = " attendee ";
    const user_id = " idattendee ";
    const retrieve_event_manager ="SELECT manager FROM MANAGER_EVENT WHERE event = :id";
    const retrieve_all_venues = "SELECT * FROM VENUE";
    const retrieve_all_roles = "SELECT * FROM ROLE";
    const retrieve_all_users ="SELECT * FROM ATTENDEE";
    const retrieve_all_events ="SELECT * FROM EVENT";
    const retrieve_all_sessions = "SELECT * FROM SESSION";
    const retrieve_all_event_management ="SELECT * FROM MANAGER_EVENT";
    const retrieve_all_registrations = "SELECT attendee_event.event,
                                               attendee_event.attendee,
                                                attendee_session.session,
                                                attendee_event.paid
                                        FROM attendee_event
                                        INNER JOIN
                                        attendee_session on attendee_session.attendee = attendee_event.attendee;";
    const create_venue = "INSERT INTO VENUE(name,capacity)VALUES(:name,:capacity)";
    const create_user = self::INSERT.
        self::user_table.
        self::begin_columns."name,password,role".self::end_columns.
        self::begin_values.":name,:password,:role".self::end_values;
    const create_event = "INSERT INTO EVENT(name,
                                      datestart,
                                      dateend,
                                      numberallowed,
                                      venue)
                                      VALUES(:name,
                                      :datestart,
                                      :dateend,
                                      :numberallowed,
                                      :venue)";
    const create_event_manager = "INSERT INTO MANAGER_EVENT(event,manager)VALUES(:event,:manager)";
    const retrieve_user = self::retrieve_all_users.self::WHERE;

    const delete_user = self::DELETE.self::user_table.self::WHERE;
    const delete_venue = "DELETE FROM VENUE WHERE idvenue = :id";
    const delete_event_sessions = "DELETE FROM SESSION WHERE event = :id;";
    const delete_event_attendees = "DELETE FROM ATTENDEE_EVENT WHERE event = :id;";
    const delete_event_management = "DELETE FROM MANAGER_EVENT WHERE event = :id;";
    const delete_event = "DELETE FROM EVENT WHERE idevent = :id;";

    const update_event_venue = "UPDATE EVENT SET venue = :venue WHERE venue = :id;";
}
